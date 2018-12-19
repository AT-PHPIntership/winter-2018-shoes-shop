## Shose Shop

### Coding style

[PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) and [PHPMD](http://phpmd.org/) are used to check the coding style. The `cicle.yml` file is also available in the project root folder, it can help us to check coding style and unit testing when a member try to create a new pull request. The circelci configurations also can help us to make comments on github commit if something is wrong.  

#### PHP_CodeSniffer
Check the coding convention following [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/). Beside that function comment must follow some rules bellow:
- All global functions, class methods must have comment to explain the meaning of functions.
- Line 1 : Short description. There is a blank line after line 1
- Next lines: explain for parameters
 - `@param   type $paramName description`
 - Explain for all parameters line by line, there is no blank line bettween parameters description.
- Last line: return description
 - `@return type`
 - There is a blank line before return description line.

Local checking:
```bash
./vendor/bin/phpcs -n --standard=phpcs.xml
```
#### PHPMD
- [Code Size Rules](http://phpmd.org/rules/codesize.html)
- [Controversial Rules](http://phpmd.org/rules/controversial.html)
- [Design Rules](http://phpmd.org/rules/design.html)
- [Naming Rules](http://phpmd.org/rules/naming.html)
 - ShortVariable except for `$id`, `$e`
- [Unused Code Rules](http://phpmd.org/rules/unusedcode.html)

Local checking:
```bash
./vendor/bin/phpmd app text phpmd.xml
```
