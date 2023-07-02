import { Col, Row } from "react-bootstrap";
import styles from "./user-list.module.css";
import UserCreateComponent from "../create/user-create.component";
import { useEffect, useState } from "react";
import UserDetailComponent from "../../../components/user-detail/user-detail.component";
import { service } from "../../../services/Service";
import { User } from "../../../models/User";

const UserListComponent: React.FC = () => {
  const [users, setUsers] = useState<User[]>([]);
  const [addedUser, setAddedUser] = useState<User | null>(null);

  useEffect(() => {
    fetchAllUsers();

    return () => {
      // console.log('unmounted');
    };

    // eslint-disable-next-line
  }, []);

  useEffect(() => {
    if (null !== addedUser) fetchAllUsers();

    // eslint-disable-next-line
  }, [addedUser]);

  const fetchAllUsers = () => {
    service.user
      .getAll()
      .then((users) => {
        // console.log(users);
        setUsers(users);
      })
      .catch((e) => {});
  };

  return (
    <div className="">
      <Row>
        <Col>
          <UserCreateComponent setAddedUser={setAddedUser} />
        </Col>
      </Row>
      <Row>
        {users.map((u: User, i) => {
          return <UserDetailComponent user={u} key={i} />;
        })}
      </Row>
    </div>
  );
};

export default UserListComponent;
