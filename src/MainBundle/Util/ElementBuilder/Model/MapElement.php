<?php

namespace MainBundle\Util\ElementBuilder\Model;
use MainBundle\Entity\Form;
use MainBundle\Entity\Element;
use MainBundle\Util\ElementBuilder\ExtendsClass\gridLayout;
use MainBundle\Util\ElementBuilder\Interfaces\IElement;

class MapElement extends gridLayout implements IElement
{

    var $id;
    var $label;
    var $tag;

    /**
     * constructor.
     * @param $label
     * @param $tag
     */
    public function __construct(Form $form, Element $element)
    {
        parent::__construct(12);
        $this->id = $element->getIdIncrement();
        $this->label = $this->processLabel($element);
        $this->tag = $this->processTag($form, $element);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * metodos que procesan info
     */
    function processLabel(Element $element)
    {
        return "<label for='{$element->getLabelFor()}' style='cursor: move'>{$element->getLabelName()}</label>";
    }

    function processTag(Form $form, Element $element)
    {

        $latitude = '-12.0462717';
        $longitude = '-77.0301229';

        if(substr_count($element->getTagValue(), '##')) {
            $location = explode("##", $element->getTagValue());
            $latitude = $location[0];
            $longitude = $location[1];
        }

        $out = '<input id="pac-input" class="controls" type="text" placeholder="Buscar...">';
        $out .= '<div id="map" style="width:100%; height:250px;"></div>';

        $out .= "
            <script type='text/javascript'>

            var map;
            var marker;
            var myLatLng;

            // FIN INIT
            function initMap() {

                myLatLng = {lat: $latitude, lng: $longitude};

                map = new google.maps.Map(document.getElementById('map'),
                {
                    center: myLatLng,
                    zoom: 13,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain']
                    },
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_BOTTOM
                    },
                    scaleControl: true,
                    streetViewControl: true,
                    streetViewControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_BOTTOM
                    },
                    fullscreenControl: true
            });

                marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'Hello World!',
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                });
                marker.addListener('click', toggleBounce);

                marker.addListener('dragend', function(event) {
                    console.log('latLng:: ' + event.latLng);
                    setTagValue(event.latLng.lat(), event.latLng.lng());
                });


                google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng, marker);
                });


                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });



            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });


            }// FIN INIT



        function placeMarker(location, oldMarker) {

            console.log('latLng 2222:: ' + location);
            setTagValue(location.lat(), location.lng());

            marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Hello World!',
                draggable: true,
                animation: google.maps.Animation.DROP,
            });

            marker.addListener('dragend', function(event) {
                console.log('latLng 33:: ' + event.latLng);
                setTagValue(event.latLng.lat(), event.latLng.lng());
            });

            if (oldMarker != undefined){
                oldMarker.setMap(null);
            }

            //oldMarker = marker;
            //map.setCenter(location);

        }

        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }

        function setTagValue(latitude, longitude) {
            $('#{$element->getTagId()}').val(latitude + '##' + longitude);
        }

        </script>
        ";

        $out .= '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDE3Iz_lQcLukpL0KgjpmjSiZae7m03Zj0&libraries=places&callback=initMap" async defer></script>';

        $out .= '
            <style>
                .controls {
                    margin-top: 10px;
                    border: 1px solid transparent;
                    border-radius: 2px 0 0 2px;
                    box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    height: 32px;
                    outline: none;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                }

                #pac-input {
                    background-color: #fff;
                    font-family: Roboto;
                    font-size: 15px;
                    font-weight: 300;
                    margin-left: 12px;
                    padding: 0 11px 0 13px;
                    text-overflow: ellipsis;
                    width: 300px;
                }

                #pac-input:focus {
                    border-color: #4d90fe;
                }

                #type-selector {
                    color: #fff;
                    background-color: #4d90fe;
                    padding: 5px 11px 0px 11px;
                }

                #type-selector label {
                    font-family: Roboto;
                    font-size: 13px;
                    font-weight: 300;
                }
                #target {
                    width: 345px;
                }
            </style>
        ';

        $out .= "<input
                type='hidden'
                class='form-control'
                name='saveEventForm[{$form->getUniqueId()}][{$element->getTagName()}_{$element->getUniqueId()}]'
                value='{$element->getTagValue()}'
                id='{$element->getTagId()}'
                />";
        $out .= "<input type='hidden' name='form[element][]' value='{$element->getIdIncrement()}'>";


        return $out;
    }
}