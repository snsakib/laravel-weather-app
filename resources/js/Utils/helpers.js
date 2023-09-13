export const average = arr => (arr.reduce((acc, val) => acc + parseFloat(val), 0) / arr.length).toFixed(2);
