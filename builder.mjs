import resolveConfig from 'tailwindcss/resolveConfig.js'
import tailwindConfig from './tailwind.config.js'
import * as fs from "fs";

const fullConfig = resolveConfig(tailwindConfig)

function extractColorVars(colors) {

    let ar = [];

    for (const [key, value] of Object.entries(colors)) {

        if (typeof value === 'string') {
            ar.push({
                'slug': key,
                'color': value,
                'name': key,
            })
        } else {
            for (const [subKey, subValue] of Object.entries(value)) {
                ar.push({
                    'slug': key + '-' + subKey,
                    'color': subValue,
                    'name': key + '-' + subKey,
                })
            }
        }

    }

    return ar;
};


fs.readFile('theme.json', (err, data) => {
    if (err) throw err;
    let json = JSON.parse(data);
    json.settings.color = {"palette": extractColorVars(fullConfig.theme.colors)}

    let jsonData = JSON.stringify(json, null, 2);
    fs.writeFileSync('theme.json', jsonData);
});




