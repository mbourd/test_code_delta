import React, { useEffect, useRef } from "react";

/**
 * Same as useEffect but do not the callback at first render
 */
const useEffectDidMount = (
  callback: React.EffectCallback,
  deps?: React.DependencyList | undefined
) => {
  const didMount = useRef(false);

  useEffect(() => {
    if (didMount.current) callback();
    else didMount.current = true;

    // eslint-disable-next-line
  }, deps);
};

export default useEffectDidMount;
