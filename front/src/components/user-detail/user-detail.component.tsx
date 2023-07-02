import { Card } from "react-bootstrap";
import { User } from "../../models/User";
import styles from "./user-detail.module.css";

type props = {
  user: User;
};

const UserDetailComponent: React.FC<props> = ({ user }) => {
  return (
    <div className={styles["user-detail-component"]}>
      <Card border="primary" className={styles["card"]}>
        <Card.Body>
          {user.name} | {user.age}
        </Card.Body>
      </Card>
    </div>
  );
};

export default UserDetailComponent;
