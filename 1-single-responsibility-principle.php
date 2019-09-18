<?php

/**
 * SRP
 * A class should have one and only one reason to change, meaning that a class should have only one job.
 */

class Circle {
    /**
     * @var float
     */
    public $radius;

    /**
     * Circle constructor.
     *
     * @param $radius
     */
    public function __construct( float $radius ) {
        $this->radius = $radius;
    }
}

class Square {
    /**
     * @var float
     */
    public $length;

    /**
     * Square constructor.
     *
     * @param $length
     */
    public function __construct( float $length ) {
        $this->length = $length;
    }
}

class AreaCalculator {
    /**
     * @var array
     */
    protected $shapes;

    /**
     * AreaCalculator constructor.
     *
     * @param array $shapes
     */
    public function __construct( array $shapes = [] ) {
        $this->shapes = $shapes;
    }

    public function sum(): float {
//        Implement logic.
    }

    /**
     * This method violates SRP.
     *
     * @return string
     */
    public function output(): string {
        return sprintf( 'Sum of the areas of the provided shapes: %d', $this->sum() );
    }
}

$shapes = array(
    new Circle( 2 ),
    new Square( 5 ),
    new Square( 6 )
);

$areas = new AreaCalculator( $shapes );

echo $areas->output();

/**
 * Wait!
 *
 * AreaCalculator shoud be responsible of calculating the areas only, not how to output the result.
 * What if we want a JSON output?
 */
class SumOutput {
    /**
     * @var AreaCalculator
     */
    protected $calculator;

    /**
     * SumOutput constructor.
     *
     * @param AreaCalculator $areaCalculator
     */
    public function __construct( AreaCalculator $areaCalculator ) {
        $this->calculator = $areaCalculator;
    }

    public function json(): string {
        // ...
    }

    public function haml(): string {
        // ...
    }

    public function html(): string {
        // ...
    }
}

$shapes = array(
    new Circle( 2 ),
    new Square( 5 ),
    new Square( 6 )
);

$areas  = new AreaCalculator( $shapes );
$output = new SumOutput( $areas );

echo $output->json();
echo $output->haml();
echo $output->html();