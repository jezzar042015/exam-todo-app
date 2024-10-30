import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api', // Ensure this matches your API's base URL
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export const useAxios = () => {
    const get = (url: string) => apiClient.get(url);
    const post = (url: string, data: any) => apiClient.post(url, data);
    const put = (url: string, data: any) => apiClient.put(url, data);
    const del = (url: string) => apiClient.delete(url);

    return { get, post, put, del };
};