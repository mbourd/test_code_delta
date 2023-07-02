import Axios, { AxiosInstance, AxiosResponse, InternalAxiosRequestConfig } from "axios";
import { environment } from "../../environments/environment";
import { service } from "../../services/Service";

const Api = (): AxiosInstance => {
  const axios = Axios.create({
    baseURL: environment.API_URL,
    withCredentials: true, // will send the current browser session credentials
  });

  // Request interceptor
  axios.interceptors.request.use(
    (request: InternalAxiosRequestConfig<any>): InternalAxiosRequestConfig<any> | Promise<InternalAxiosRequestConfig<any>> => {
      // let _request = {
      //   ...request,
      //   headers: {
      //     ...request.headers,

      //     // Authorization: `Bearer ${service.session.getToken()}`,
      //     // 'x-access-token': service.session.getToken(),

      //     // lng: i18n.resolvedLanguage
      //   },
      // };
      // return _request as unknown as InternalAxiosRequestConfig<any>;

      // // // Recommended version
      // request.headers.set('Authorization', `Bearer ${service.session.getToken()}`);
      // // request.headers.set('x-access-token', service.session.getToken());
      // request.headers.set('lng', i18n.resolvedLanguage);

      return request;
    },
    (error) => {}
  );

  // Response interceptor
  axios.interceptors.response.use(
    (resp: AxiosResponse<any, any>): AxiosResponse<any, any> | Promise<AxiosResponse<any, any>> => {
      // Any status code that lie within the range of 2xx cause this function to trigger
      // Do something with response data
      return resp.data;
    },
    (error: any) => {
      // Any status codes that falls outside the range of 2xx cause this function to trigger
      // Do something with response error
      console.error(error);

      return Promise.reject(error.response.data);
    }
  );

  return axios;
};

export const api = Api();
