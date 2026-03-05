import './bootstrap';

// Gunakan path absolut ke file distribusinya untuk membungkam error Vite 7
import '../../node_modules/preline/dist/preline.js';

window.addEventListener('load', () => {
  if (window.HSStaticMethods) {
    window.HSStaticMethods.autoInit();
  }
});