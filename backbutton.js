window.addEventListener('pageshow', function(event) {
    var historyTraversal = event.persisted ||
                            (typeof window.performance != 'undefined' &&
                             window.performance.navigation.type === 2);
    if (historyTraversal) {
      // Close the navigation bar
      var checkbox = document.getElementById('check');
      checkbox.checked = false;
    }
  });

/*
                    CHAT GPT HELPED WITH THIS
This code listens to the pageshow event which is fired when the user navigates to the page again, 
for example, when the user presses the back button on the phone. 
Then, it checks if the navigation was done through the browser's history (event.persisted) or 
if it was a new navigation (window.performance.navigation.type === 2). 
If it was a history traversal, the code closes the navigation bar by unchecking the checkbox input with ID check.

*/