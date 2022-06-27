<?php


namespace Core;

use RuntimeException;

class Renderer
{
    private string $templatesDir;

    public function __construct(string $templatesDir)
    {
        $this->templatesDir = $templatesDir;
    }

    /**
     * Генерирует представление
     * @param string $templatePath Файл с шаблоном
     * @param array $params Параметры, которые нужно передать в шаблон
     * @return string
     */
    public function generate(string $templatePath, array $params = []): string
    {
        extract($params, EXTR_OVERWRITE);
        ob_start();
        $templatePath = rtrim($this->templatesDir, '/\\') . '/' . trim($templatePath, '\\/');
        if (!file_exists($templatePath)) {
            throw new RuntimeException('Файл шаблона не найден ' . $templatePath);
        }
        include $templatePath;
        return ob_get_clean();
    }
}