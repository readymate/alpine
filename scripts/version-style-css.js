// Modified from: https://github.com/ivdekov/package-json-to-wordpress-style-css/blob/master/index.js

const fs = require('fs');
const path = require('path');
const packageJSON = require(path.resolve(process.env.PWD, 'package.json'));
const destination = 'style.css';

function updateStyleCSSWithPackageJSONData(newVersion) {
    const packageData = generateStyleCSSData(newVersion);

    fs.readFile(destination, 'utf8', function(err, styleData) {
        if (err) {
            return console.log(err);
        }

        const oldVersion = styleData.toString().match(/(\d+\.)(\d+\.)(\d+)/g)[0];
        const updatedStyleCSSData = getUpdatedStyleCSSData(styleData, packageData);

        if (oldVersion === newVersion) {
            return console.log('No need. Versions are the same...')
        }

        fs.writeFile(destination, updatedStyleCSSData, 'utf8', function(err) {
            if (err) {
                return console.log(err);
            }
            console.log(
                `style.css version successfully updated from ${oldVersion} to ${newVersion}`
            );
        });
    });
}

function getUpdatedStyleCSSData(styleData, packageData) {
    let updatedStyleCSSData = '';
    /*
     * Regular expression for matching the header section
     * of a WordPress Theme main style.css file.
     */
    const styleCSSHeaderRegexp = /\/\*[\s\S]*?Theme[\s\S]*?\*\//;

    /*
     * If no header comment is found in style.css, generate the
     * header and append the contents of the style.css file to it.
     * If a header comment is found, replace it with the new
     * data extracted from the package.json file (leaving intact
     * any other content that exists in the style.css file).
     */
    if (!styleData.match(styleCSSHeaderRegexp)) {
        updatedStyleCSSData = packageData + styleData;
    } else {
        updatedStyleCSSData = styleData.replace(styleCSSHeaderRegexp, packageData);
    }

    return updatedStyleCSSData;
}

function createStyleCSSWithPackageJSONData(newVersion) {
    const packageData = generateStyleCSSData(newVersion);

    fs.writeFile(destination, packageData, error => {
        if (error) {
            return console.error(error);
        }
    });
}

function generateStyleCSSData(newVersion) {
    const themeName = packageJSON.name
        .replace(/-/g, ' ')
        .replace(/(?:^|\s)\S/g, a => a.toUpperCase());

    const styleData = `/*
* Theme Name: ${themeName}
* Text Domain: ${packageJSON.name}
* Description: ${packageJSON.description}
* Author: ${packageJSON.author}
* Version: ${newVersion}
* Theme URI: ${packageJSON.themeUri}
* Author URI: ${packageJSON.authorUri}
* Github Theme URI: ${packageJSON.githubThemeUri}
* License: ${packageJSON.licence}
* License URI: ${packageJSON.licenceUri}
* Tags: ${packageJSON.themeTags}
*/`;

    return styleData;
}

function createOrUpdateStyleCSS(newVersion) {
    if (fs.existsSync(destination)) {
        updateStyleCSSWithPackageJSONData(newVersion);
    } else {
        createStyleCSSWithPackageJSONData(newVersion);
    }
}

createOrUpdateStyleCSS(packageJSON.version)
