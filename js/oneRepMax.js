$('#oneRepMax').submit(function(e){
    e.preventDefault();
    var weight = $('#weightx').val();
    var reps = $('#reps').val();
    var max = ((weight * 0.333 * reps) + weight);
    var result = Math.floor(max);
    console.log(result);
    console.log(weight + "," + reps);
    $('#result').html(result);
})
