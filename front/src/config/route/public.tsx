import React from "react";
import { Route, Routes } from "react-router";
import ErrorNotFoundComponent from "../../pages/error/not-found/not-found.component";
import HomeComponent from "../../pages/home/home.component";
import UserListComponent from "../../pages/user/list/user-list.component";

const routes = [
  { path: "/", component: HomeComponent },
  { path: "/home", component: HomeComponent },
  { path: "/users", component: UserListComponent },
  { path: "*", component: ErrorNotFoundComponent },
];

const PublicRoutes = () => {
  return (
    <Routes>
      {routes.map((route, index) => {
        return (
          <Route path={route.path} key={index} element={<route.component />} />
        );
      })}
    </Routes>
  );
};

export default PublicRoutes;
