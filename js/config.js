var firebaseConfig = {
  apiKey: "AIzaSyAkNACA6ClnOJ0ozX8g-kSvbHr-CHMgDJs",
  authDomain: "wago-ba859.firebaseapp.com",
  databaseURL: "https://wago-ba859.firebaseio.com",
  projectId: "wago-ba859",
  storageBucket: "wago-ba859.appspot.com",
  messagingSenderId: "641790845359",
  appId: "1:641790845359:web:621353577b49d1db510f5a",
  measurementId: "G-JWFYZ4X4QN"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

var db = firebase.database();
var auth = firebase.auth();
var storage = firebase.storage();
