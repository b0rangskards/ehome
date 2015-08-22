function updateMapCenter(map, newLatLng) {
    $(map).gmap3({
        map: {
            options: {
                center: [newLatLng[0], newLatLng[1]]
            }
        }
    });
}