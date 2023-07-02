import { api } from "../config/axios/Api";
import { User } from "../models/User";

export class UserService {
  addUser(data: {}): Promise<User> {
    return api.post("/users/add", data);
  }

  getAll(): Promise<User[]> {
    return api.get("/users/all");
  }
}
