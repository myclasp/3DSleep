# 3DSleep
Create 3D representations of the quality of your sleep. Conencts to FitBit to get data and uses ShapeJS to create shapes.

grabsitbitsleep.php needs to go on a server with OAUTH and PHP installed. Grab fitbitphp from https://github.com/heyitspavel/fitbitphp

Create a new app on dev.fitbit.com and add your secret and key.

Then fire up  grabsitbitsleep.php in your browser, it will return x numbers each representing a 2 hour period of sleep.

Head over to http://shapejs.shapeways.com/creator paste in sleepshape.js or sleepshapegyroid.js and add "text" inputs so you have x +1 in total. For the first enter 0.01 and the rest your numbers from grabfitbitsleep.php.

Hit "run script" and it will generate a 3d viz of your sleep. each shape represents a 2 hour period of sleep and the roundedness of corners represents how restful your sleep was. sharp corners = restless.

