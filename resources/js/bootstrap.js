import axios from 'axios';
// import { Inertia } from '@inertiajs/inertia';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set base URL for API (adjust if your API is at /api)
axios.defaults.baseURL = '/api';

export default axios;
