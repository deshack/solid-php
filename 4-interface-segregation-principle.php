<?php

/**
 * Interface Segregation Principle.
 *
 * A client should never be forced to implement an interface that it doesn't use or clients shouldn't be forced to
 * depend on methods they do not use.
 */

interface BadShapeInterface {
    public function area(): float;

    public function volume(): float;
}

/**
 * But wait, a Circle or a Square don't have volume!
 */
interface ShapeInterface {
    public function area(): float;
}

interface SolidShapeInterface {
    public function volume(): float;
}

class Cuboid implements ShapeInterface, SolidShapeInterface {
    public function area(): float {
        // calculate the surface area of the cuboid
    }

    public function volume(): float {
        // calculate the volume of the cuboid
    }
}

abstract class AbstractCalculator {
    /**
     * @var array
     */
    protected $shapes;

    /**
     * AbstractCalculator constructor.
     *
     * @param array $shapes
     */
    public function __construct( array $shapes ) {
        $this->shapes = $shapes;
    }

    public abstract function sum(): float;
}

class AreaCalculator extends AbstractCalculator {
    /**
     * @return float
     */
    public function sum(): float {
        $area = [];
        foreach ( $this->shapes as $shape ) {
            if ( is_a( $shape, ShapeInterface::class ) ) {
                $area[] = $shape->area();
                continue;
            }

            throw new RuntimeException();
        }

        return array_sum( $area );
    }
}

class VolumeCalculator extends AbstractCalculator {
    /**
     * @return float
     */
    public function sum(): float {
        $area = [];
        foreach ( $this->shapes as $shape ) {
            if ( is_a( $shape, SolidShapeInterface::class ) ) {
                $area[] = $shape->volume();
                continue;
            }

            throw new RuntimeException();
        }

        return array_sum( $area );
    }
}