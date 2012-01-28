//
//  EventEditViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2012.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import "EventEditViewController.h"

@implementation EventEditViewController

@synthesize labels;
@synthesize placeholders;
@synthesize rankingPicker;
@synthesize rankingPickerData;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        
        self.labels = [NSArray arrayWithObjects:@"Ranking",
                       @"Título",
                       @"Local",
                       @"Data",
                       @"Hora",
                       @"ITM",
                       @"Rebuy",
                       @"Addon",
                       @"Rake",
                       @"Buy-in",
                       @"Obs",
                       @"Notificar por e-mail", nil];
        
        self.placeholders = [NSArray arrayWithObjects:@"Ranking",
                             @"Nome do evento",
                             @"Local",
                             @"Data",
                             @"Hora",
                             @"Posições pagas",
                             @"Rebuy",
                             @"Addon",
                             @"Rake",
                             @"Buy-in",
                             @"Obs",
                             @"Notificar por e-mail", nil];
        
        
        NSArray *array = [[NSArray alloc] initWithObjects:@"Luke",@"Leia",@"Han",@"Chewbacca",@"Artoo",
                          @"Threepio",@"lando",nil];
        
        self.rankingPickerData = array;
        [array release];
        
        appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
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

    // Uncomment the following line to preserve selection between presentations.
    // self.clearsSelectionOnViewWillAppear = NO;
 
    // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
    // self.navigationItem.rightBarButtonItem = self.editButtonItem;
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
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
    
    [self showRankingPicker];
}

- (void)showRankingPicker {
    
    NSLog(@"mostrando o picker do ranking");
    
    self.tableView.frame = CGRectMake(self.tableView.frame.origin.x, self.tableView.frame.origin.x, self.tableView.frame.size.width, appDelegate.window.frame.size.height);
    
    NSLog(@"height: %f", appDelegate.tabBarController.tabBar.frame.size.height);
    rankingPicker =[[UIPickerView alloc] init];
    rankingPicker.showsSelectionIndicator = YES;
    rankingPicker.userInteractionEnabled  = YES;
    rankingPicker.delegate   = self;
    rankingPicker.dataSource = self;
    [appDelegate.window addSubview:rankingPicker];
    
    CGRect pickerFrame = rankingPicker.frame;
    pickerFrame.origin.y = appDelegate.window.frame.size.height;
    rankingPicker.frame = pickerFrame;
    
    [UIView beginAnimations: nil context: NULL];
    [UIView setAnimationDuration: 0.3];
    [UIView setAnimationCurve:UIViewAnimationCurveEaseIn];
    
    pickerFrame.origin.y = appDelegate.window.frame.size.height-pickerFrame.size.height;
    rankingPicker.frame = pickerFrame;
    
    self.tableView.frame = CGRectMake(self.tableView.frame.origin.x, self.tableView.frame.origin.x, self.tableView.frame.size.width, self.tableView.frame.size.height-rankingPicker.frame.size.height+appDelegate.tabBarController.tabBar.frame.size.height);
    
    [UIView commitAnimations];
    
//    [rankingPicker release];
}

- (void)hideRankingPicker {
    
     self.tableView.frame = CGRectMake(self.tableView.frame.origin.x, self.tableView.frame.origin.x, self.tableView.frame.size.width, self.tableView.frame.size.height-rankingPicker.frame.size.height+appDelegate.tabBarController.tabBar.frame.size.height);
    
    [UIView beginAnimations: nil context: NULL];
    [UIView setAnimationDuration: 0.3];
    [UIView setAnimationCurve:UIViewAnimationCurveEaseOut];

    CGRect pickerFrame = rankingPicker.frame;
    pickerFrame.origin.y = appDelegate.window.frame.size.height;
    rankingPicker.frame = pickerFrame;

    
    [UIView commitAnimations];    
}

- (void)viewWillDisappear:(BOOL)animated
{

    [self hideRankingPicker];
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{

    [rankingPicker removeFromSuperview];
    [rankingPicker release];
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{

    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    return 12;
}

//- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
//{
//    static NSString *CellIdentifier = @"Cell";
//    
//    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
//    if (cell == nil) {
//        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleValue2 reuseIdentifier:CellIdentifier] autorelease];
//    }
//    
//    cell.textLabel.text = [labels objectAtIndex:indexPath.row];
//    [cell setSelectionStyle:UITableViewCellSelectionStyleNone];
//    
//    // Configure the cell...
//    
//    return cell;
//}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    
    static NSString *CellIdentifier = @"Cell";
    
    ELCTextfieldCell *cell = (ELCTextfieldCell*)[tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[ELCTextfieldCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
    }
	
	[self configureCell:cell atIndexPath:indexPath];
    
    return cell;
}

- (void)configureCell:(ELCTextfieldCell *)cell atIndexPath:(NSIndexPath *)indexPath {
	
	cell.leftLabel.text = [self.labels objectAtIndex:indexPath.row];
	cell.rightTextField.placeholder = [self.placeholders objectAtIndex:indexPath.row];
	cell.indexPath = indexPath;
	cell.delegate = self;
    //Disables UITableViewCell from accidentally becoming selected.
    cell.selectionStyle = UITableViewCellSelectionStyleNone;
    
    if(indexPath.row == 0)
		[cell.rightTextField setEnabled:NO];
//	if(indexPath.row >= 4)        
//		[cell.rightTextField setSecureTextEntry:YES];
//    
    if( indexPath.row==11 )
        [cell.rightTextField setReturnKeyType:UIReturnKeyDone];
    else
        [cell.rightTextField setReturnKeyType:UIReturnKeyNext];
//    
//    if( indexPath.row==2 || indexPath.row==3 )
//        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeWords];
//    else
//        [cell.rightTextField setAutocapitalizationType:UITextAutocapitalizationTypeNone];
    
    cell.rightTextField.tag = indexPath.row;
    
    [cell.rightTextField setClearButtonMode:UITextFieldViewModeWhileEditing];
    
    [cell.rightTextField setAutocorrectionType:UITextAutocorrectionTypeNo];
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

-(void)textFieldDidReturnWithIndexPath:(NSIndexPath*)indexPath {
    
    NSIndexPath *path = [NSIndexPath indexPathForRow:indexPath.row+1 inSection:indexPath.section];
    
    UITextField *theTextField = [(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:path] rightTextField];
    
	if(indexPath.row < [labels count]-1) {
        
		
		[theTextField becomeFirstResponder];
		[self.tableView scrollToRowAtIndexPath:path atScrollPosition:UITableViewScrollPositionTop animated:YES];
	}else{
        
		[[(ELCTextfieldCell*)[self.tableView cellForRowAtIndexPath:indexPath] rightTextField] resignFirstResponder];
	}
}

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







#pragma mark Picker data source methods
-(NSInteger)numberOfComponentsInPickerView:(UIPickerView *)pickerView {

	return 1;
}

-(NSInteger)pickerView:(UIPickerView *)pickerView numberOfRowsInComponent:(NSInteger)component {
	
    return [rankingPickerData count];
}


#pragma mark Picker delegate method
-(NSString *)pickerView:(UIPickerView *)pickerView titleForRow:(NSInteger)row forComponent:(NSInteger)component {

    return [rankingPickerData objectAtIndex:row];
}

@end
