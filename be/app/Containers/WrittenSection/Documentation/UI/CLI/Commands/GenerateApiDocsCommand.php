<?php

namespace App\Containers\WrittenSection\Documentation\UI\CLI\Commands;

use App\Containers\WrittenSection\Documentation\Actions\GenerateDocumentationAction;
use App\Ship\Parents\Commands\ConsoleCommand;

class GenerateApiDocsCommand extends ConsoleCommand
{
	protected $signature = "update:apidoc";

	protected $description = "Generate API Documentations with (API-Doc-JS)";

	public function handle(): void
	{
		app(GenerateDocumentationAction::class)->run($this);
	}
}