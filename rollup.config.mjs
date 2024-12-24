import postcss from 'rollup-plugin-postcss'
import postcssNesting from 'postcss-nesting'
import autoprefixer from 'autoprefixer'
import postcssImport from 'postcss-import'
import resolve from '@rollup/plugin-node-resolve'
import commonjs from '@rollup/plugin-commonjs'
import { babel } from '@rollup/plugin-babel'
import fs from 'fs'

// function names should be self explanatory
function getDirectories(path) {
    return fs.readdirSync(path).filter(function (file) {
        return fs.statSync(path + '/' + file).isDirectory()
    })
}

function fileExists(name) {
    try {
        return fs.statSync(name).isFile()
    } catch {
        return false
    }
}

const blocks = getDirectories('./blocks/')

// probably a more efficient method for setting up config but ¯\_(ツ)_/¯
let config = [
    {
        input: './src/js/main.js',
        output: {
            file: './assets/js/main.js',
            format: 'iife',
        },
        plugins: [resolve(), commonjs(), babel({ babelHelpers: 'bundled' })],
    },
    {
        input: './src/js/editor.js',
        output: {
            file: './assets/js/editor.js',
            format: 'iife',
        },
        plugins: [resolve(), commonjs(), babel({ babelHelpers: 'bundled' })],
    },
    {
        input: './src/css/main.css',
        output: {
            file: './assets/css/main.css',
        },
        plugins: [
            postcss({
                extract: true,
                minimize: true,
                syntax: 'postcss-scss',
                plugins: [postcssImport(), autoprefixer(), postcssNesting()],
            }),
        ],
    },
    {
        input: './src/css/editor.css',
        output: {
            file: './assets/css/editor.css',
        },
        plugins: [
            postcss({
                extract: true,
                minimize: true,
                syntax: 'postcss-scss',
                plugins: [postcssImport(), autoprefixer(), postcssNesting()],
            }),
        ],
    },
]

// add custom blocks to config
blocks.forEach((b) => {
    const cssInput = `blocks/${b}/${b}.css`
    const jsInput = `blocks/${b}/${b}.js`
    const bConfig = []

    // only attempt to register of css file exists
    if (fileExists(cssInput)) {
        bConfig.push({
            input: `blocks/${b}/${b}.css`,
            output: {
                file: `./assets/blocks/${b}/${b}.min.css`,
            },
            plugins: [
                postcss({
                    extract: true,
                    minimize: true,
                    syntax: 'postcss-scss',
                    plugins: [
                        postcssImport(),
                        autoprefixer(),
                        postcssNesting(),
                    ],
                }),
            ],
        })
    }

    // same with js
    if (fileExists(jsInput)) {
        bConfig.push({
            input: `blocks/${b}/${b}.js`,
            output: {
                file: `./assets/blocks/${b}/${b}.min.js`,
            },
        })
    }

    config = [...config, ...bConfig]
})

export default config
