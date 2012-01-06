ECHO OFF
CLS
ECHO Processing all examples
ECHO.
ECHO  [01/26] A simple line chart
 php -q %~dp0Example1.php
ECHO  [02/26] A cubic curve graph
 php -q %~dp0Example2.php
ECHO  [03/26] An overlayed bar graph
 php -q %~dp0Example3.php
ECHO  [04/26] Showing how to draw area
 php -q %~dp0Example4.php
ECHO  [05/26] A limits graph
 php -q %~dp0Example5.php
ECHO  [06/26] A simple filled line graph
 php -q %~dp0Example6.php
ECHO  [07/26] A filled cubic curve graph
 php -q %~dp0Example7.php
ECHO  [08/26] A radar graph
 php -q %~dp0Example8.php
ECHO  [09/26] Showing how to use labels
 php -q %~dp0Example9.php
ECHO  [10/26] A 3D exploded pie graph
 php -q %~dp0Example10.php
ECHO  [11/26] A true bar graph
 php -q %~dp0Example12.php
ECHO  [12/26] A 2D exploded pie graph
 php -q %~dp0Example13.php
ECHO  [13/26] A smooth flat pie graph
 php -q %~dp0Example14.php
ECHO  [14/26] Playing with line style and pictures inclusion
 php -q %~dp0Example15.php
ECHO  [15/26] Importing CSV data
 php -q %~dp0Example16.php
ECHO  [16/26] Playing with axis
 php -q %~dp0Example17.php
ECHO  [17/26] Missing values
 php -q %~dp0Example18.php
ECHO  [18/26] Error reporting
 php -q %~dp0Example19.php
ECHO  [19/26] Stacked bar graph
 php -q %~dp0Example20.php
ECHO  [20/26] Playing with background
 php -q %~dp0Example21.php
ECHO  [21/26] Customizing plot charts
 php -q %~dp0Example22.php
ECHO  [22/26] Playing with background - Bis
 php -q %~dp0Example23.php
ECHO  [23/26] X Versus Y chart
 php -q %~dp0Example24.php
ECHO  [24/26] Naked and easy!
 php -q %~dp0Naked.php
ECHO  [25/26] Let's go fast, draw small!
 php -q %~dp0SmallGraph.php
ECHO  [26/26] A Small stacked chart
 php -q %~dp0SmallStacked.php
ECHO.
ECHO Rendering complete!
PAUSE
