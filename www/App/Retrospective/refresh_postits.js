function refreshPostIts() {
    $.ajax({
        url: 'Retrospective/refresh_postits.php',
        type: 'GET',
        data: {
            room_id: getUrlParameter('room_id')
        },
        success: function(response) {
            $('#positif-column').html(response.positive);
            $('#a_ameliorer-column').html(response.improve);
            $('#negatif-column').html(response.negative);
        },
        dataType: 'json'
    });
}

function getUrlParameter(name) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(window.location.href);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

setInterval(refreshPostIts, 5000);
