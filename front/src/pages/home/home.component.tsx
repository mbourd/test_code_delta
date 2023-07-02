import styles from "./home.module.css";

const HomeComponent: React.FC<any> = ({}) => {
  return (
    <div className={styles['component']}>
      <h1 className="text-center">Welcome home ! 👋</h1>
    </div>
  );
};

export default HomeComponent;
