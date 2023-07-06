<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;

class StudentTest extends TestCase
{
    /**
     * Verifica que los atributos del estudiante se llenen correctamente.
     */
    public function testFillAttributes()
    {
        // Creamos una instancia del estudiante
        $student = new Student();

        // Llenamos los atributos
        $student->fill([
            'name' => 'John',
            'surname' => 'Doe',
            'address' => '123 Main St',
            'email' => 'john@example.com',
        ]);

        // Verificamos que los atributos se hayan llenado correctamente
        $this->assertEquals('John', $student->name);
        $this->assertEquals('Doe', $student->surname);
        $this->assertEquals('123 Main St', $student->address);
        $this->assertEquals('john@example.com', $student->email);
    }
}