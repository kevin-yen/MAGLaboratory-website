<?php

namespace MtHaml\Filter;

use MtHaml\NodeVisitor\RendererAbstract as Renderer;
use MtHaml\Node\Filter;

class YieldContent extends Plain
{
    public function optimize(Renderer $renderer, Filter $node, $options)
    {
        /*
        $renderer->indent();
        $this->renderFilter($renderer, $node);
        $renderer->undent();
        */
        $renderer->write($options['yield']);
    }
}


