import { Col, Row } from "react-bootstrap";
import { Link } from "react-router-dom";
import styles from './menu.module.css';

const MenuComponent: React.FC = () => {
  return (
    <div className="">
      <nav className="navbar navbar-expand-sm navbar-light bg-light">
        <div className="container">
          <Row>
            <Col md={6}>
              <h1>Test code Delta RM</h1>
            </Col>
            <Col md={3}>
              <Link to="/home">Home</Link>
            </Col>
            <Col md={3}>
              <Link to="/users">Users</Link>
            </Col>
          </Row>
        </div>
      </nav>
    </div>
  );
};

export default MenuComponent;
