import { AppService } from "./app.service";
import { UserService } from "./user.service";

class Service {
  app: AppService;
  user: UserService;

  constructor() {
    this.app = new AppService();
    this.user = new UserService();
  }
}

export const service = new Service();
