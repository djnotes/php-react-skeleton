import React, { Component } from 'react';
import {BrowserRouter as Router, Route, Navigate, Routes } from 'react-router-dom'
// import {Router, Route, Redirect } from 'react-router-dom'
import NavBar from './components/navbar/NavBar';
import Teams from './components/pages/teams/Teams';
import Calendar from './components/pages/calendar/Calendar';
import Error from './components/error/Error';
import Footer from './components/footer/Footer';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPlus, faTrash, faEdit, faCheck, faSearch, faTimes } from '@fortawesome/free-solid-svg-icons';

library.add(faPlus, faTrash, faEdit, faCheck, faSearch, faTimes);

class App extends Component {
  render() {
    return (
      <Router>
        <NavBar />
        <Routes>
          <Route path="/" exact component={() => <Navigate to="/teams" />} />
          <Route path="/teams" component={Teams} />
          <Route path="/calendar" component={Calendar} />
          <Route component={() => (
            <Error message="We couldn't find what you're looking for." />
          )}/>
        </Routes>
        <Footer />
      </Router>
    );
  }
}

export default App;
