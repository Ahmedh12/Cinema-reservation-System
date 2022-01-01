<?php 
  include 'admin/db_connect.php';
  $movies = $conn->query("SELECT * FROM movies  limit 10");
?>

     
                  <center><h3 class="text-primary">Now Showing</h3></center>

<div id="movie-carousel-field">

  <div class="list-prev list-nav">
    <a href="javascript:void(0)" class="text"><i class="fa fa-angle-left"></i></a>
  </div>
  <div class="list">
    <?php while($row=$movies->fetch_assoc()): ?>
        <div class="movie-item">
          <img class="" src="assets/img/<?php echo $row['poster_image']  ?>" alt="<?php echo $row['title'] ?>" >
          <div class="mov-det">
            <button type="button" class="btn btn-primary" data-id="<?php echo $row['id'].$row['room'] ?>">Reserve Seat</button>
          </div>
        </div>
    <?php endwhile; ?>
  </div>
   <div class="list-next list-nav">
    <a href="javascript:void(0)" class="text"><i class="fa fa-angle-right"></i></a>
  </div>
</div>

<script>
  
  $('#movie-carousel-field .list-next').click(function(){
    $('#movie-carousel-field .list').animate({
    scrollLeft:$('#movie-carousel-field .list').scrollLeft() + ($('#movie-carousel-field .list').find('img').width() * 3)
   }, 'slow');
  })
  $('#movie-carousel-field .list-prev').click(function(){
    $('#movie-carousel-field .list').animate({
    scrollLeft:$('#movie-carousel-field .list').scrollLeft() - ($('#movie-carousel-field .list').find('img').width() * 3)
   }, 'slow');
  })
  $('.mov-det button').click(function(){
    location.replace('index.php?page=hall1&id='+$(this).attr('data-id'));
    location.replace('index.php?page=hall'+$(this).attr('data-id')[1]+'&id='+$(this).attr('data-id')[0])
  })
</script>