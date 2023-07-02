import styles from "./not-found.module.css";

const ErrorNotFoundComponent = () => {
  return (
    <div className={styles["page-error"]}>
      <h1 className="text-center">404 - Page not found</h1>
    </div>
  );
};

export default ErrorNotFoundComponent;
