//
//  AccountViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "AccountViewController.h"

@implementation AccountViewController
@synthesize labels, placeholders, defaultValues;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];

    UIBarButtonItem *saveButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemSave target:self action:@selector(saveAccount)];
 
    // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
    self.navigationItem.rightBarButtonItem = saveButton;
    
    self.labels = [NSArray arrayWithObjects:@"Username", 
                   @"E-mail", 
                   @"Nome", 
                   @"Sobrenome", 
                   @"Senha", 
                   @"Confirmação", 
                   nil];
	
	self.placeholders = [NSArray arrayWithObjects:@"obrigatório", 
                         @"obrigatório", 
                         @"obrigatório", 
                         @"opcional",  
                         @"obrigatório",   
                         @"obrigatório", 
                         nil];
    
	self.defaultValues = [NSArray arrayWithObjects:@"lstegun", 
                         @"lucianostegun@gmail.com", 
                         @"Luciano", 
                         @"Stegun",  
                         @"unidunite",   
                         @"unidunite", 
                         nil];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    
    self.title = @"Conta";
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (void)configureCell:(ELCTextfieldCell *)cell atIndexPath:(NSIndexPath *)indexPath {
	
	cell.leftLabel.text = [self.labels objectAtIndex:indexPath.row];
	cell.rightTextField.placeholder = [self.placeholders objectAtIndex:indexPath.row];
	cell.indexPath = indexPath;
	cell.delegate = self;
    //Disables UITableViewCell from accidentally becoming selected.
    cell.selectionStyle = UITableViewCellSelectionStyleNone;
    
    if(indexPath.row == 0)
        cell.rightTextField.enabled = NO;
    else
        cell.rightTextField.enabled = YES;
    
    if(indexPath.row == 1)
		[cell.rightTextField setKeyboardType:UIKeyboardTypeEmailAddress];
	if(indexPath.row >= 4)        
		[cell.rightTextField setSecureTextEntry:YES];
    
    if( indexPath.row==5 )
        [cell.rightTextField setReturnKeyType:UIReturnKeyDone];
    else
        [cell.rightTextField setReturnKeyType:UIReturnKeyNext];
    
    if( indexPath.row==2 || indexPath.row==3 )
        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeWords];
    else
        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeNone];
    
    cell.rightTextField.tag = indexPath.row;
    
    cell.rightTextField.text = [self.defaultValues objectAtIndex:indexPath.row];
    
    [cell.rightTextField setClearButtonMode:UITextFieldViewModeWhileEditing];
    
    [cell.rightTextField setAutocorrectionType:UITextAutocorrectionTypeNo];
}

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{

    return 3;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    int rows = 0;
    
    switch (section) {
        case 0:
            rows = 4;
            break;
        case 1:
            rows = 6;
            break;
        case 3:
            rows = 1;
            break;
    }
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    NSString *CellIdentifier = [NSString stringWithFormat:@"Cell-Section%i", indexPath.section];

    if( indexPath.section==0 ){
        
        ELCTextfieldCell *cell = (ELCTextfieldCell*)[tableView dequeueReusableCellWithIdentifier:CellIdentifier];
        if (cell == nil) {
            cell = [[[ELCTextfieldCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
        }
        
        [self configureCell:cell atIndexPath:indexPath];
        
        return cell;
    }else{

        UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
        if (cell == nil) {
            cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
        }
        
        return cell;
    }
}

-(void)textFieldDidReturnWithIndexPath:(NSIndexPath*)indexPath {
    
    if( indexPath.section > 0 )
        return;
    
    NSIndexPath *path = [NSIndexPath indexPathForRow:indexPath.row+1 inSection:indexPath.section];
    
    UITextField *theTextField = [(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:path] rightTextField];
    
	if(indexPath.row < 3) {
        
		
		[theTextField becomeFirstResponder];
		[self.tableView scrollToRowAtIndexPath:path atScrollPosition:UITableViewScrollPositionTop animated:YES];
	}else{
        
		[[(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:indexPath] rightTextField] resignFirstResponder];
	}
}

-(void)updateTextLabelAtIndexPath:(NSIndexPath*)indexPath string:(NSString*)string {
    
    switch (indexPath.row) {
        case 0:
            username = [string copy];
            break;
        case 1:
            emailAddress = [string copy];
            break;
        case 2:
            firstName = [string copy];
            break;
        case 3:
            lastName = [string copy];
            break;
        case 4:
            password = [string copy];
            break;
        case 5:
            passwordConfirm = [string copy];
            break;
    }
}

/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/

/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source
        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
    }   
}
*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
}

@end
