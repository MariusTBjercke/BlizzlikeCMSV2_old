// Node modules
import 'bootstrap';
import 'htmx.org';
import 'unpoly';

// Other assets
import './lib/navigation';
import './lib/login';
import './lib/register';

// @ts-ignore
window.htmx = require('htmx.org');

// Images
// @ts-ignore
import Favicon from '../img/icons/favicon.png';
new Image(Favicon);