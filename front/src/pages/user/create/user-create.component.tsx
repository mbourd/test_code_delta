import styles from "./user-create.module.css";

import React, { createRef, useContext, useEffect, useState } from "react";
import { Col, Row, Button, Form, InputGroup } from "react-bootstrap";
import { ErrorMessage, Formik, FormikProps } from "formik";
import * as Yup from "yup";
import { service } from "../../../services/Service";
import { User } from "../../../models/User";

type typesControls = User & {
  // name: string;
  // age: number;
};

type props = {
  setAddedUser: React.Dispatch<React.SetStateAction<User | null>>;
};

const UserCreateComponent: React.FC<props> = ({ setAddedUser }) => {
  const [isSending, setIsSending] = useState(false);
  const refForm = createRef<FormikProps<typesControls>>();

  return (
    <div className="">
      <Row>
        <Col>
          <Formik
            innerRef={refForm}
            initialValues={{
              name: "",
              age: 0,
            }}
            validationSchema={() =>
              Yup.object().shape({
                name: Yup.string()
                  .test(
                    "len",
                    "The user name must be between 2 and 50 characters.",
                    (val) => {
                      if (val) {
                        return (
                          val.toString().length >= 2 &&
                          val.toString().length <= 50
                        );
                      }
                      return false;
                    }
                  )
                  .test(
                    "upper",
                    "The user name must start with an uppercase character.",
                    (val) => {
                      if (val) {
                        const char = val.toString()[0];
                        return char !== char.toLowerCase();
                      }
                      return false;
                    }
                  )
                  .required("This field is required!"),
                age: Yup.number()
                  .positive("The age can only be positive")
                  .min(0, "The age can only be positive")
                  .max(120, "The age can not exceed 120 years old"),
              })
            }
            onSubmit={async (values, { resetForm, setFieldValue }) => {
              const { name, age } = values;

              if (!isSending) {
                setIsSending(true);
                service.user
                  .addUser({ name, age })
                  .then((u) => {
                    // console.log(u);
                    resetForm();
                    service.app.toastify("New user added ! " + u.name);
                    setAddedUser(u);
                  })
                  .catch((e) => {
                    service.app.toastify(JSON.stringify(e));
                  })
                  .finally(() => {
                    setIsSending(false);
                  });
              }
            }}
          >
            {({
              values,
              handleSubmit,
              handleChange,
              errors,
              touched,
              setFieldValue,
              setFieldTouched,
              setErrors,
            }) => {
              const { name, age } = values;

              return (
                <Form>
                  <Form.Group className="mb-3" controlId="formBasicName">
                    <Form.Label>Name</Form.Label>
                    <Form.Control
                      name="name" // control name
                      type="text"
                      placeholder="Enter the name"
                      required={true}
                      autoComplete=""
                      disabled={isSending}
                      value={name}
                      onChange={(e) => {
                        setFieldValue(e.target.name, e.target.value);
                        setFieldTouched(e.target.name, true, false);
                      }}
                    />
                    <ErrorMessage
                      name="name"
                      component="div"
                      className="alert alert-danger"
                    />
                  </Form.Group>

                  <Form.Group className="mb-3" controlId="formBasicAge">
                    <Form.Label>Age</Form.Label>
                    <Form.Control
                      name="age" // control name
                      type="number"
                      placeholder="age"
                      min="0"
                      max={120}
                      autoComplete=""
                      disabled={isSending}
                      value={age}
                      onChange={(e) => {
                        setFieldValue(e.target.name, e.target.value);
                        setFieldTouched(e.target.name, true, false);
                      }}
                    />
                    <ErrorMessage
                      name="age"
                      component="div"
                      className="alert alert-danger"
                    />
                  </Form.Group>

                  <Form.Group>
                    <Button
                      disabled={isSending}
                      type="submit"
                      variant="info"
                      onClick={(e: any) => handleSubmit(e)}
                    >
                      {isSending && (
                        <span className="spinner-border spinner-border-sm"></span>
                      )}
                      {!isSending && <span>Add a new user</span>}
                    </Button>
                  </Form.Group>
                </Form>
              );
            }}
          </Formik>
        </Col>
      </Row>
    </div>
  );
};

export default UserCreateComponent;
