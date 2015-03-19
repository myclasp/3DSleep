



 var voxelSize = 0.08*MM;


function createShape(size,score,x,y,z){
  // the cube for the dice
  //var size = args[0];
  var box = new Box(x,y,z,size,size,size);
  
  // round the corners and edges by intersecting cube with sphere
  // sphere with radius 32% of cube length is sufficient
  var fudge = (score / 10 *0.35) +0.1;
  var radius = size -fudge*size;
  //var radius = size - (score/5)*size;
  var sphere = new Sphere(x,y,z,radius);
  var intersect = new Intersection();
  intersect.add(box);
  intersect.add(sphere);



  var intersectg = new Intersection();
  intersectg.add(intersect);
  intersectg.add(new VolumePatterns.Gyroid(5*MM, 0.1*MM));
 



  return intersectg;



}




function main(args) {
  // the cube for the dice
  var size = args[0];
  var union=Union();
  var x=0;
  var y=0;
  var z=0;

  
  //step through args makinh shapes and adding to union
  for (index = 1; index < args.length; ++index) {
    union.add(createShape(size,args[index],x,y,z));
    x=x+size/2;
    y=y+size/2;
    z=z+size/2;

  }


  //union.add(createShape(size,args[1],x,y,z));


  //union.add(createShape(size,args[2],x+size/2,y+size/2,z+size/2));





/*
  var box = new Box(0,0,0,size,size,size);
  
  // round the corners and edges by intersecting cube with sphere
  // sphere with radius 32% of cube length is sufficient
  var radius = size - 0.32*size;
  var sphere = new Sphere(size/2,size/2,size/2,radius);
  var union = new Union();
  union.add(box);
  union.add(sphere);
  */
        
  
  var halfgrid = size *2;
  var grid = createGrid(-halfgrid,halfgrid,-halfgrid,halfgrid,-halfgrid,halfgrid,voxelSize);
  var maker = new GridMaker();
  maker.setSource(union);
  maker.makeGrid(grid);
  return grid;
}
