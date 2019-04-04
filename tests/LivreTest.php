<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Entity\Livre;
use App\Controller\ApiController;

final class LivreTest extends TestCase
{
    
    public function testGetBook(): void
    {

        $this->getBook(
            $bookId = 2
        );
    }
}
