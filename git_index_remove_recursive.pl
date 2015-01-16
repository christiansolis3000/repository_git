#!/usr/bin/env perl
# git index-update recursive remove (in directory) script
# https://gist.github.com/mugifly/5134150
# ex: $ perl git_index_remove_recursive.pl "/home/hoge/project/aaa/"

use warnings;
use strict;

use Cwd;
use File::Find;
use File::Spec;

our $GIT_CMD_PATH = 'git';

my $target_dir = check_argv();
my @target_files = find_target_files($target_dir);
git_index_remove(\@target_files);
finish($GIT_CMD_PATH, $target_dir);
exit;

sub check_argv {
	unless(defined($ARGV[0])){
		print "[Error!] Not specified a target directory! (ex: '/home/hoge/project/aaa/'";
		exit;
	}
	
	my $target_dir = $ARGV[0];	
	unless(File::Spec->file_name_is_absolute($target_dir)){
		print "[Error!] Target directory must be an absolute path!";
		exit;
	}
		
	print "[Target directory]\n";
	print "$target_dir\n";
			
	print "\n";
	print "Are you right with this directory? [y/n]: ";
	my $ans = <STDIN>;
	if($ans !~ /y/i){
		print "\nCancelled.\n";
		exit;
	}
	print "\n";
	return $target_dir;
}

sub find_target_files {
	my $target_dir = shift;
	chdir($target_dir);
	
	my $git_root_dir = `$GIT_CMD_PATH rev-parse --show-toplevel`;
	chomp($git_root_dir);
	if($git_root_dir eq ''){
		print "[Error!] Git command path are invalid.\n";
		exit;
	}
	chdir($git_root_dir);
	
	print "[Target files]\n";
	my @target_files = ();
	File::Find::find(sub {
		my $path =$File::Find::name;
		$path =~ s/$git_root_dir\///;
		print " * $path\n";
		push(@target_files, $path);
	}, $target_dir);
	
	my $files_num = @target_files;	
	
	print "\nYou CAN'T cancellation and reconstruction (even from Git), after delete. \nAre you sure to DELETE these $files_num files? [y/n]: ";
	my $ans = <STDIN>;
	if($ans !~ /y/i){
		print "\nCancelled.\n";
		exit;
	}
	print "\n";	
	return @target_files;
}

sub git_index_remove {
	my $target_files_ref = shift;

	my $git_root_dir = `$GIT_CMD_PATH rev-parse --show-toplevel`;
	chdir($git_root_dir);
	
	print "Deleting...\n";
	foreach(@$target_files_ref){
		print " * $_\n";
		print `$GIT_CMD_PATH filter-branch -f --index-filter 'git update-index --remove \"$_\"' HEAD`;
		print "\n\n";
	}
}

sub finish {
	my ($git_cmd_path, $target_path_one) = @_;
	print "Delete completed!\n\n";
	
	print "Are you push (with --force) to remote repository? [y/n]: ";
	my $ans = <STDIN>;
	if($ans !~ /y/i){
		print "\n\nCompleted :)\n Please perform Git push by yourself, if necessary.\n";
		exit;
	}
	
	chdir($target_path_one);
	print "\n";
	print `$GIT_CMD_PATH push --force`;
	
	print "\n\nCompleted :)\n";
}
