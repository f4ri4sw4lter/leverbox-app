// ...existing code...
import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE || 'http://localhost:8081/api',
  headers: { 'Content-Type': 'application/json' },
  withCredentials: false,
});


api.interceptors.response.use(
  response => response,
  error => {
    const payload: any = {
      message: 'Error de red',
      status: error?.response?.status ?? 0,
      errors: null,
      original: null,
    };

    if (error?.response?.data) {
      const d = error.response.data;
      payload.message = d.message ?? payload.message;
      payload.errors = d.errors ?? d.data ?? null;
      payload.original = d;
    } else {
      payload.original = error?.message ?? null;
    }

    console.error('[api] error:', payload);

    try {
      window.dispatchEvent(new CustomEvent('api-error', { detail: payload }));
    } catch (e) {
      console.error(e);
    }

    return Promise.reject(payload);
  }
);

export default api;