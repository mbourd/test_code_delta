import React from "react";
import logo from "./logo.svg";
import "./App.css";
import PublicRoutes from "./config/route/public";
import { Col, Row } from "react-bootstrap";
import MenuComponent from "./components/menu/menu.components";
import { ToastContainer } from "react-toastify";

const App: React.FC = () => {
  return (
    <div className="">
      <header>
        <MenuComponent />
      </header>
      <div className="container">
        <Row>
          <Col md={3}></Col>
          <Col md={6}>
            <PublicRoutes />
          </Col>
          <Col md={3}></Col>
        </Row>
      </div>
      <footer></footer>
      <ToastContainer />
    </div>
  );
};

export default App;
