import { Col, Row } from "react-bootstrap";
import styles from "./user-list.module.css";
import UserCreateComponent from "../create/user-create.component";
import { useEffect, useState } from "react";
import UserDetailComponent from "../../../components/user-detail/user-detail.component";
import { service } from "../../../services/Service";
import { User } from "../../../models/User";
import useEffectDidMount from "../../../hooks/useEffectDidMount";
import useEffectWillUnmount from "../../../hooks/useEffectWillUnmount";

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

  useEffectDidMount(() => {
    fetchAllUsers();

    // eslint-disable-next-line
  }, [addedUser]);

  useEffectWillUnmount(() => {
    console.log("unmounted");
  }, []);

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
