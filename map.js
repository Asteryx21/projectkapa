/*                            Icon Markers                                  */
let greenIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
let redIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

let markers = L.markerClusterGroup({
  disableClusteringAtZoom: 50,

});
//background tile set
const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap'
});
const Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	maxZoom: 18,
  attribution: 'Tiles &copy; Esri '
  //&mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community
});

const baseMaps = {
  "Προεπιλογή": osm,
  "Δορυφόρος": Esri_WorldImagery
};

// init map
const map = L.map('map', {
  center: new L.LatLng(38.246639, 21.734573), //
  zoom: 10,
  zoomControl: false,
  layers: [osm], 
  maxZoom: 18,

});

const sidebar = L.control.sidebar('sidebar', {
    position: 'left'
});

map.addControl(sidebar);

let report_desc = [];
let report_imgs= [];

let groupA = L.layerGroup();
let groupB = L.layerGroup();
let layerGroup = L.layerGroup().addTo(map);

map.addLayer(markers);
const overlayMaps = {
    };
let layerControl= L.control.layers(baseMaps,overlayMaps, {position:'topleft'}).addTo(map);


L.control.locate({showPopup: false, drawMarker: false}).addTo(map);


// Add a button to switch the layers
const switchLayersButton = L.easyButton({
  position: 'bottomleft',
  states: [{
    stateName: 'default-state',
    icon: 'fa-solid fa-layer-group fa-4x',
    title: 'Εναλλαγή υποβάθρου',
    onClick: function(btn, map) {
      if (map.hasLayer(osm)) {
        map.removeLayer(osm);
        Esri_WorldImagery.addTo(map);
      } else {
        map.removeLayer(Esri_WorldImagery);
        osm.addTo(map);
      }
    }
  }]
}).addTo(map);

const greenMarkers = L.easyButton({
  position: 'topright',
  states: [{
    stateName: 'default-state',
    icon: '<img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png">',
    title: 'Δράσεις',
    onClick: function(btn, map) {
      if (map.hasLayer(groupA)) {
        map.removeLayer(groupA);
      } else {
        groupA.addTo(map);
      }
    }
  }]
}).addTo(map);

const redMarkers = L.easyButton({
  position: 'topright',
  states: [{
    stateName: 'default-state',
    icon: '<img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png">',
    title: 'Αναφερόμενες περιοχές',
    onClick: function(btn, map) {
      if (map.hasLayer(groupB)) {
        map.removeLayer(groupB);
      } else {
        groupB.addTo(map);
      }
    }
  }]
}).addTo(map);

getData();

async function getData(){
  const response = await fetch('get_reports.php');
  const data = await response.json();

  layerGroup.clearLayers();
  markers.clearLayers();
  layerControl.removeLayer(groupA);
  layerControl.removeLayer(groupB);

  const places = [];
  const markersA = [];
  const markersB = [];

  for(item of data){
    if (item.type=='Red'){
      report_desc.push(item.description);
      report_imgs.push(item.image)
      const text = item.description;
      places.push([item.latitude,item.longtitude,text,item.image,item.type]);   
    } else{
      const text = '<b>'+'Πληροφορίες: '+'</b>' + item.description ;
      places.push([item.latitude,item.longtitude,text,item.image,item.type]);
    }
  }

  for(var i=0; i < places.length; i++) {
    switch (places[i][4]) {            
        case 'Green' : 
            markersA.push(L.marker([places[i][0], places[i][1]], {title: places[i][2], icon: greenIcon }).on('click', onClick));
            break;        
        case 'Red' :
            //markersB.push(L.marker([places[i][0], places[i][1]], {title: places[i][2], icon: redIcon }).on('click', onClick));
            markers.addLayer(L.marker([places[i][0], places[i][1]], {title: places[i][2], icon: redIcon }).on('click', onClick));
            markersB.push(markers);
            break;
        default :
            break;
    }
  }
    //add the groups of markers to layerGroups      
    groupA = L.layerGroup(markersA);
    groupB = L.layerGroup(markersB);
    //Creating layer group
    groupA.addTo(layerGroup);
    groupB.addTo(layerGroup);
    //Control on the Top Left that handles the switching between A and B 
    layerControl.addOverlay(groupA, "Δράσεις" );
    layerControl.addOverlay(groupB, "Αναφερόμενες περιοχές" );
}

const elem = document.createElement("img");
const loggedin = document.getElementById("logged_in");

$('#close').on('click', function () {
  $(".statusMsg").fadeIn();
  $('.statusMsg').html('');
  $(".progress-bar").width('0%');
  $('.center').hide();

})


function onClick(e) {

  if (loggedin==null && this.options.title==''){
   
    const modal = document.querySelector(".modalLogin");
    const closeModalBtn = document.querySelector(".ok_btn");
    const closeModal = function () {
      modal.classList.add("hideform");
      overlay.classList.add("hideform"); 

    };
    closeModalBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
    modal.classList.remove("hideform");
    overlay.classList.remove("hideform");
    // Swal.fire('Πρώτα πρέπει να συνδεθείτε με το λογαριασμό σας.')
  }
  else if (this.options.title=='' &&loggedin!==null ) {
    $('.center').show();
    map.removeLayer(select_marker);
   
  } else{
      sidebar.show();  
      sidebar.setContent(this.options.title);
      const check = report_desc.indexOf(this.options.title);
      // console.log(report_imgs[check]); 
      if (check !== -1 && report_imgs[check]!== ''){
        elem.setAttribute("src", "uploads/"+ report_imgs[check]);
        elem.setAttribute("class","rep_img");
        elem.setAttribute("onclick",'ExpandImage(this.src)');
        document.getElementById("sidebar").appendChild(elem);
      }
    }
  

}
// Enlarge image
const overlay = document.querySelector(".overlay");
const modal = document.querySelector(".modal");
const closeModalBtn = document.querySelector(".btn-close");
const closeModal = function () {
  modal.classList.add("hideform");
  overlay.classList.add("hideform"); 

};
closeModalBtn.addEventListener("click", closeModal);
overlay.addEventListener("click", closeModal);
function ExpandImage(_src){
  modal.classList.remove("hideform");
  overlay.classList.remove("hideform");

  const enlarged_img = document.querySelector("#enlarged_img");

  enlarged_img.setAttribute("src",_src);
}



//Allowed select marker to be placed only within Greece borders.
let select_marker;
$.getJSON('borders.json', function(borders) {
  const geojsonLayer = L.geoJSON(borders, {
    style: {
      fillOpacity: 0,
      stroke: false
    }
  }).addTo(map);

  
  map.on('click', function (e) {
    $('.center').hide();
    if (select_marker) {
      map.removeLayer(select_marker);
    }
    const markerBounds = L.latLngBounds([L.latLng(e.latlng.lat, e.latlng.lng)]);
    if (geojsonLayer.getBounds().intersects(markerBounds)) {   
      document.getElementById('coords').value = e.latlng.lat + ", " + e.latlng.lng;
      select_marker = new L.Marker(e.latlng).on('click', onClick);
      select_marker.addTo(map);
    } //else alert('Only within greece allowed');
  });
  
});


// make the "?" tips button stop jumping after clicked.
const tipsbtn = document.querySelector('#tips');

tipsbtn.addEventListener('click', () => {
  tipsbtn.classList.add('clicked');
});


function Tips(){
  const modal = document.querySelector(".modalTips");
  const closeModalBtn = document.querySelector(".tips_btn");

  modal.classList.remove("hideform");
  overlay.classList.remove("hideform");

  const closeModal = function () {
      modal.classList.add("hideform");
      overlay.classList.add("hideform"); 
   
  };
  closeModalBtn.addEventListener("click", closeModal);
  overlay.addEventListener("click", closeModal);
}

// get lat,long from google maps URL
var url = "https://www.google.com/maps/place/38%C2%B016'38.8%22N+21%C2%B044'43.8%22E/@38.277435,21.745503,17z/data=!3m1!4b1!4m4!3m3!8m2!3d38.277435!4d21.745503";
var regex = new RegExp('@(.*),(.*),');
var lat_long_match = url.match(regex);
var lat = lat_long_match[1];
var long = lat_long_match[2];