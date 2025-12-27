import axios from 'axios';
import type { AxiosResponse, InternalAxiosRequestConfig } from 'axios';

const instance = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || 'http://localhost/api/v1',
  headers: {
    'Content-Type': 'application/json',
  },
  withCredentials: true,
});

instance.interceptors.request.use(
  (config: InternalAxiosRequestConfig) => {
    const token = localStorage.getItem('auth_token');
    config.headers = config.headers ?? {};
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

instance.interceptors.response.use(
  (response: AxiosResponse) => response,
  (error) => Promise.reject(error)
);

export const http = {
  get: <T>(url: string, config?: InternalAxiosRequestConfig) =>
    instance.get<T>(url, config).then(res => res.data),
  post: <T>(url: string, data?: any, config?: InternalAxiosRequestConfig) =>
    instance.post<T>(url, data, config).then(res => res.data),
  put: <T>(url: string, data?: any, config?: InternalAxiosRequestConfig) =>
    instance.put<T>(url, data, config).then(res => res.data),
  delete: <T>(url: string, config?: InternalAxiosRequestConfig) =>
    instance.delete<T>(url, config).then(res => res.data),
};
