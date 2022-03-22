// Node modules
import 'bootstrap';
import 'htmx.org';

// Other assets
import './base';
import './login';
import './register';

// @ts-ignore
window.htmx = require('htmx.org');

// Images
// @ts-ignore
import Favicon from '../img/favicon.png';
new Image(Favicon);