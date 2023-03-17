const overlay = document.querySelector(".overlay");
const loggedin = document.getElementById("logged_in");

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, { 
        locale: 'el',
        initialView: 'dayGridMonth',
        headerToolbar: {
            start: 'title',
            center: '',
            end: 'prev,next'
        },
        events: 'get_events.php',
        eventTimeFormat: { 
            hour: '2-digit',
            minute: '2-digit',
            hour12:false
        },
        eventClick: function(info) {
            
            info.jsEvent.preventDefault();
            // change the border color
            info.el.style.borderColor = 'green';

            if (loggedin == null){
                const modal = document.querySelector(".modal");
                const closeModalBtn = document.querySelector(".btn-close");
                document.getElementById("eventid").innerHTML = info.event.title + '\n';
                document.getElementById("descr").innerHTML = info.event.extendedProps.description;
                document.getElementById("intr").innerHTML = '<br>Ενδιαφερόμενοι: '+ info.event.extendedProps.participants + '<br><br> <b>Κάνοντας σύνδεση στο λογαριασμό σας μπορείτε και εσείς να δηλώσετε ενδιαφέρον για τη δράση!</b>';
                

                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
                const closeModal = function () {
                    modal.classList.add("hidden");
                    overlay.classList.add("hidden"); 
                 
                };
                closeModalBtn.addEventListener("click", closeModal);
                overlay.addEventListener("click", closeModal);

            } else {
                // Modal control
                const closeModalBtn = document.querySelector(".btn-close"+info.event.id);
                const modal = document.querySelector(".modal" +info.event.id );
                const closeModal = function () {
                    modal.classList.add("hidden");
                    overlay.classList.add("hidden");
                    $('#placeholder').load(' #placeholder');     
                
                };
                closeModalBtn.addEventListener("click", closeModal);
                overlay.addEventListener("click", closeModal);

                //Different modal based on event.
                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
            }



            // interested uninterested buttons control
            $('.cnf').on('click', function(){
                var dataid = $(this).data('id');
                $drasi = $(this);
                $.ajax({
                    url: 'calendar.php',
                    type: 'post',
                    data: {
                        'interested': 1,
                        'eventid': dataid
                    },
                    success: function(response){
                        $drasi.parent().find('p#intr').text('Ενδιαφερόμενοι: '+ response);
                        $drasi.addClass('hidden');
                        $drasi.siblings().removeClass('hidden');
                    }
                });
            });
            $('.uncf').on('click', function(){
                var dataid = $(this).data('id');
                $drasi = $(this);
                $.ajax({
                    url: 'calendar.php',
                    type: 'post',
                    data: {
                        'uninterested': 1,
                        'eventid': dataid
                    },
                    success: function(response){
                        $drasi.parent().find('p#intr').text('Ενδιαφερόμενοι: '+ response);
                        $drasi.addClass('hidden');
                        $drasi.siblings().removeClass('hidden');
                    }
                });
            });
              
        }
    });
    calendar.render();
});  

