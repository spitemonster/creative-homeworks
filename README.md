# Creative Homeworks

a wordpress block theme built for creative homeworks

## installation

```bash
git clone https://github.com/spitemonster/creative-homeworks
cd creative-homeworks
rm -rf .git
npm install
npm run watch // watch updates to core and block css
npm run build // build all core and block assets
```

## usage

create new blocks by using the command `npx hygen block new`. this will prompt a few questions and generate a block directory in `/blocks/`. blocks are auto-registered once they are created; you may immediately begin writing css and javascript for your block if necessary, and it will be visible to ACF for field registration.

uses `rollup.js` for bundling css and javascript and is configured to use PostCSS out of the box. rollup will watch changes to `src/main/css/main.css` and `src/main/js/main.js` as well as any block-level assets that share the name of their block and bundle them into `/assets/blocks/`, i.e.:

```bash
example-block
 - example-block.css // bundled into `/assets/blocks/example-block/example-block.min.css`
 - example.css // not watched by rollup
 - example-block.js // watched by rollup
 - example.js // not watched by rollup
```

if you remove any of these files neither WP or Rollup will look for them and they will not be registered and this will not throw an error; this is a reasonable strategy if you do not need to add any custom css or js for a block you are building.
