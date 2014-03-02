$('#oneRepMax').submit(function(e){
    e.preventDefault();
    var weight = $('#weight-rep').val();
    var reps = $('#reps').val();
    var max = ((weight * 0.333 * reps) + weight);
    var result = Math.floor(max);

    $('#rep-max #result-small, #rep-max #result-medium, #rep-max #result-large').html(result);
    $('#rep-max #result-small, #rep-max #result-medium, #rep-max #result-large').effect("bounce", "slow");
    
})
