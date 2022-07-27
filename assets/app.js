/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// charge jquery
const $ = require('jquery');
// charge le framework css bootstrap
require('bootstrap');

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.sass';

// start the Stimulus application
import './bootstrap';

// test de js
console.log('hello webpack!');
