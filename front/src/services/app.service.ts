import { ToastOptions, toast } from "react-toastify";

export class AppService {
  toastify(msg: string, options?: ToastOptions<{}>) {
    const ops = {
      type: "default",
      position: "top-left",
      autoClose: 5000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: true,
      draggable: true,
      progress: undefined,
      theme: "light",
      ...options,
    } as ToastOptions<{}>;

    // https://fkhadra.github.io/react-toastify/introduction/
    toast(msg, ops);
  }
}
