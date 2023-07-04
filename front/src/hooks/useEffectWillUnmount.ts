import React, { useEffect, useRef } from "react";

/**
 * Same as useEffect but do not the callback at first render
 */
const useEffectWillUnmount = (
  callback: React.EffectCallback,
  deps?: React.DependencyList | undefined
) => {
  useEffect((): any => {
    return callback;

    // eslint-disable-next-line
  }, deps);
};

export default useEffectWillUnmount;
