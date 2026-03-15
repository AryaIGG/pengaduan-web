import './bootstrap';
import $ from 'jquery';
import DataTable from 'datatables.net-dt';

import '../../node_modules/preline/dist/preline.js';

window.$ = $;
window.jQuery = $;
window.DataTable = DataTable;

window.addEventListener('load', () => {
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
});
