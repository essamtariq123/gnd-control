import firebase from 'firebase/compat/app';
import 'firebase/compat/auth';
import 'firebase/compat/firestore';
import 'firebase/compat/database'

 var config = {
    apiKey: 'AIzaSyBHBEfYi6r4f82D_7BIyTlIBe59TTqiMsg',
    authDomain: 'gnd-control-backend.firebaseapp.com',
    projectId: 'gnd-control-backend',
    storageBucket: 'gnd-control-backend.appspot.com',
    messagingSenderId: '18319398742',
    appId: '1:18319398742:web:4b811836d522ca7d6428f7',
    databaseURL: 'https://gnd-control-backend-default-rtdb.firebaseio.com/'
 };

export const db = firebase
  .initializeApp(config)
.database()