# _dsgnsystm
A system for designing WordPress themes for Gutenberg using CSS custom properties (CSS-variables)

### The Underlying Concept
At it’s simplest, this tool connects Typographic, Color, and Spacing decsions to a CSS-variable system that designers can use to quickly create Gutenberg-ready themes for WordPress.

### Getting Started
1. To use the system, fist install the `_dsgnsystm-theme` in your WordPress install, but do not activate it.
2. Next, install the `_dsgnsystm-childtheme-starter` and activate it.
3. Try changing some of the variables in the `style.css` file of `_dsgnsystm-childtheme-starter` and watch how it effects the site design on both the frontend and the block editor.
4. Next, install the `_dsgnsystm-childtheme-elegant-business` and activate it. Watch how the design changes and then take a look at the `style.css` file to see how little code is necessary to achieve a unique design. 
5. If you’re feeling really experimental, make a copy of the one the child themes and try to roll out your own original theme design by only changing the available CSS-variables.

### Future thinking
- Make a plugin version of this system
- Add the CSS-variables to Gutenberg itself

### Other notes
- The buildtool in the `_dsgnsystm-theme` is not setup properly—please **do not** use it. For now, you can use Codekit but eventually it will be replaced by a working build tool. 
