import React from "react";
import ReactDOM from 'react-dom';
import NewsReader from './components/NewsReader';
import '../css/app.css';

const App = () => {
    return (
        <NewsReader />
    );
};

const root = document.querySelector("#app");
ReactDOM.render(<App/>, root);
